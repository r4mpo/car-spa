<template>
    
    <NavBar />

    <div class="c-311b92">
        <h4 class="center">Usuários</h4>
    </div>

    <table class="centered highlight">
        <thead>
            <tr>
                <th>Usuário</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>...................</td>
                <td>...................</td>
                <td>
                    <i class="material-icons c-blue pointer">create</i>
                    <i class="material-icons c-red pointer">delete</i>
                </td>
            </tr>
        </tbody>
    </table>

</template>

<script>
import NavBar from "../components/NavBar.vue";

export default {
    // data() {
    //     return {}
    // }
    components: {
        NavBar,
    },
}
</script>

<style>

</style>