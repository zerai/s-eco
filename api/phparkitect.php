<?php

declare(strict_types=1);

use Arkitect\ClassSet;
use Arkitect\CLI\Config;
use Arkitect\Expression\ForClasses\HaveNameMatching;
use Arkitect\Expression\ForClasses\NotHaveDependencyOutsideNamespace;
use Arkitect\Expression\ForClasses\ResideInOneOfTheseNamespaces;
use Arkitect\RuleBuilders\Architecture\Architecture;
use Arkitect\Rules\Rule;

return static function (Config $config): void {
    $classSet = ClassSet::fromDir(__DIR__.'/src');

    $layeredArchitectureRules = Architecture::withComponents()
        ->component('Controller')->definedBy('App\Controller\*')
        ->component('Service')->definedBy('App\Service\*')
        ->component('Repository')->definedBy('App\Repository\*')
        ->component('Entity')->definedBy('App\Entity\*')

        ->where('Controller')->mayDependOnComponents('Service', 'Entity')
        ->where('Service')->mayDependOnComponents('Repository', 'Entity')
        ->where('Repository')->mayDependOnComponents('Entity')
        ->where('Entity')->shouldNotDependOnAnyComponent()

        ->rules();

    $serviceNamingRule = Rule::allClasses()
        ->that(new ResideInOneOfTheseNamespaces('App\Service'))
        ->should(new HaveNameMatching('*Service'))
        ->because('we want uniform naming for services');

    $repositoryNamingRule = Rule::allClasses()
        ->that(new ResideInOneOfTheseNamespaces('App\Repository'))
        ->should(new HaveNameMatching('*Repository'))
        ->because('we want uniform naming for repositories');

    $config->add($classSet, $serviceNamingRule, $repositoryNamingRule, ...$layeredArchitectureRules);

    /**++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     *
     *      INGESTING
     *
     *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
     */
    $ingestingClassSet = ClassSet::fromDir(__DIR__ . '/context/ingesting/src');

    $allowedPhpDependencies = require_once __DIR__ . '/tools/ark/config/ingesting/allowed_php_deps_in_core.php';
    $allowedVendorDependenciesInIngestingCore = require_once __DIR__ . '/tools/ark/config/ingesting/allowed_vendor_deps_in_core.php';
    $allowedVendorDependenciesInIngestingAdapters = require_once __DIR__ . '/tools/ark/config/ingesting/allowed_vendor_deps_in_adapters.php';

    $ingestingPortAndAdapterArchitectureRules = Architecture::withComponents()
        ->component('Core')->definedBy('Ingesting\Core\*')
        ->component('Adapters')->definedBy('Ingesting\AdapterFor*')
        ->component('Infrastructure')->definedBy('Ingesting\Infrastructure\*')

        ->where('Infrastructure')->mayDependOnComponents('Core')
        ->where('Adapters')->mayDependOnComponents('Core', 'Infrastructure')
        ->where('Core')->shouldNotDependOnAnyComponent()
        ->rules();


    $allowedDependenciesInCoreCode = array_merge($allowedPhpDependencies, $allowedVendorDependenciesInIngestingCore);
    $ingestingCoreIsolationRule = Rule::allClasses()
        ->that(new ResideInOneOfTheseNamespaces('Ingesting\Core'))
        ->should(new NotHaveDependencyOutsideNamespace('Ingesting\Core', $allowedDependenciesInCoreCode))
        ->because('we want isolate our ingesting core domain from external world.');


    $allowedDependenciesInIngestingAdapters = array_merge($allowedPhpDependencies, $allowedVendorDependenciesInIngestingAdapters);
    $ingestingAdaptersIsolationRule = Rule::allClasses()
        //->except('Ingesting\Adapter\Http\Web\ModuleDetailsController', 'Ingesting\Adapter\Packagist\ModuleReaderOnPackagist')
        ->that(new ResideInOneOfTheseNamespaces('Ingesting\Adapter*'))
        ->should(new NotHaveDependencyOutsideNamespace('Ingesting\Core', $allowedDependenciesInIngestingAdapters))
        ->because('we want isolate our ingesting Adapters from ever growing dependencies.');

    $config->add($ingestingClassSet, $ingestingCoreIsolationRule, $ingestingAdaptersIsolationRule, ...$ingestingPortAndAdapterArchitectureRules);


};
