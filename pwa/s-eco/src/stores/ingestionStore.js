import { defineStore } from "pinia";
import { ref } from 'vue';

export const useIngestionStore = defineStore('ingestion', () => {
    const dataItems = ref(null);

    const getData = async () => {
        const response = await fetch('/api/ingesting/items');
        dataItems.value = await response.json();
    }

    return { dataItems, getData }
});