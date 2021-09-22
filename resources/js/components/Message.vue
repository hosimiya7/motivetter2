<template>
    <div>
        <p v-if="this.$store.state.selectedCommand === 0">{{ characters.character_template.line }}</p>
        <Goal v-if="this.$store.state.selectedCommand === 1"/>
        <Achieve v-if="this.$store.state.selectedCommand === 2"/>
        <Chara v-if="this.$store.state.selectedCommand === 3"/>
        <Game v-if="this.$store.state.selectedCommand === 4"/>
        <CharaStatus v-if="this.$store.state.selectedCommand === 5"/>
        <CharaFood v-if="this.$store.state.selectedCommand === 6"/>
        <!-- <CharaPicture v-if="this.$store.state.selectedCommand === 7"/> -->
        <!-- <CharaFarewell v-if="this.$store.state.selectedCommand === 8"/> -->
    </div>
</template>

<script>
export default {
data() {
            return{
                characters: [],
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