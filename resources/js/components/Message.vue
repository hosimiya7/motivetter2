<template>
    <div>
        <p v-if="this.$store.state.selectedCommand === 0">{{ characters.character_template.line }}</p>
        <Goal v-if="this.$store.state.selectedCommand === 1"/>
        <Achieve v-if="this.$store.state.selectedCommand === 2"/>
        <Chara v-if="this.$store.state.selectedCommand === 3"/>
        <Game v-if="this.$store.state.selectedCommand === 4"/>
    </div>
</template>

<script>
export default {
data() {
            return{
                characters: []
            }
        },
        mounted() {
            window.axios.get('/api/character/show')
            .then(response =>{
                this.characters = response['data'];
            })
            .catch(function (error) {
                console.log(error);
            });
        }
}
</script>