<script setup>
defineProps({
    value: String,
    required: Boolean
});
</script>

<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="value">{{ value }}{{required ? '*' : ''}}</span>
        <span v-else><slot /></span>
    </label>
</template>
