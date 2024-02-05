<template>
    <div class="app-form-wrap">
        <slot />
    </div>
</template>

<style scoped>

.app-form-wrap {
    width: 100%; 
    height: 100vh;
    display: flex; 
    justify-content: center; 
    align-items: center;
    padding: 25px;
}

@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    .app-form-wrap {
        width: 100%; 
        display: flex; 
        justify-content: center; 
        align-items: center;
        padding: 25px;
    }
  }

</style>