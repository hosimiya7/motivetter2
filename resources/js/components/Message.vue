<template>
  <div>
    <p v-if="this.$store.state.screenId === 0">{{ this.$store.state.characters.character_template.line }}</p>
    <Goal v-if="this.$store.state.screenId === 1" />
    <Achieve v-if="this.$store.state.screenId === 2" />
    <Chara v-if="this.$store.state.screenId === 3" />
    <Game v-if="this.$store.state.screenId === 4" />
    <CharaStatus v-if="this.$store.state.screenId === 5" />
    <CharaFood v-if="this.$store.state.screenId === 6" />
    <CharaPictures v-if="this.$store.state.screenId === 7" />
    <CharaFarewell v-if="this.$store.state.screenId === 8" />
    <GameSlot v-if="this.$store.state.screenId === 9" />
    <GameHighAndLow v-if="this.$store.state.screenId === 10" />
    <GameOmikuji v-if="this.$store.state.screenId === 11" />
    <GameFoodShop v-if="this.$store.state.screenId === 12" />
  </div>
</template>

<script>
export default {
  data() {
    return {
      characters: []
    };
  },
  mounted() {
  }
};
</script>