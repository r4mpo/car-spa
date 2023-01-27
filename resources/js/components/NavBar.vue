<template>

    <div class="bg-311b92 bc-dd1dff">
        <nav class="bg-311b92">
            <div class="nav-wrapper">
                <a href="#" class="brand-logo center">CAR SHOP</a>
            </div>
        </nav>

        <div class="side-style">
            <div class="nav-wrapper">
                <a href="#" data-target="slide-out" class="sidenav-trigger btn bg-311b92"><i
                        class="material-icons">menu</i></a>
            </div>
        </div>

        <ul id="slide-out" class="sidenav sidenav-close bg-311b92">
            <li><router-link :to="{ name: 'carros' }" style="color: #fff;"><i class="material-icons c-green pointer">directions_car</i>Carros</router-link></li>
            <li><router-link :to="{ name: 'usuarios' }" style="color: #fff;"><i class="material-icons c-green pointer">person</i>Usuários</router-link></li>
        </ul>

    </div>

</template>

<script>

// Abrindo/fechando a side-nav
$(document).ready(function () {
    $('.sidenav').sidenav();
});

export default {
    name: 'NavBar',

    mounted() {
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });
    }
}

</script>

<style>
/*  */
</style>