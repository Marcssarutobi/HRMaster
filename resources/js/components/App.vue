<template>

    <div>
        <sidebare/>
    </div>

</template>
<script>
import sidebare from './sidebare.vue';
export default {
    name: 'AppView',
    components: {
        sidebare
    }
    
}
</script>

<style>
    body{
        background: #e1e1e1;
    }
    .views{
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;
        gap: 10px;
        padding: 20px;
        width: 100%;
        height: 100%;
    }
    .dropdown-toggle::after{
        display: none;
    }
    .dropdown-item{
        cursor: pointer;
    }
</style>