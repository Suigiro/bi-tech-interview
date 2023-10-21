<template>
    <div class="loading">
        <b-spinner label="Spinning"></b-spinner>
    </div>
</template>

<script>
export default {
  name: 'Loading'
}
</script>

<style>
.loading {
    grid-area: content;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
