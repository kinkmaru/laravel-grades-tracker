<template>
    <div class="container">
        <div>
            <h1><router-link :to="{name: 'Home'}">Home</router-link></h1>

            <hr>
                <router-view></router-view>
            <!--<transition name="fade">-->
            <!--</transition>-->
        </div>
    </div>
</template>

<style>
</style>

<script>

    export default{
    }
</script>