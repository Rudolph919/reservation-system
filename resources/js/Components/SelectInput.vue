<script setup>

defineProps({
    optionList: {
        type: Object
    }
});

</script>

<template>
    <select class="mt-1 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
        <option  selected value="">Select a resource type</option>
        <option v-for="option in optionList" :value="option.id">
            {{ option.name }}
        </option>

    </select>
</template>


