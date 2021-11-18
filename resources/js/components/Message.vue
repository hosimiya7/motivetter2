<template>
  <div>
    <p v-if="this.$store.state.screenId === 0">{{ this.line }}</p>
    <Goal v-if="this.$store.state.screenId === 1" />
    <Achieve :unit="this.unit" v-if="this.$store.state.screenId === 2" />
    <Chara v-if="this.$store.state.screenId === 3" />
    <Game :point="this.point" v-if="this.$store.state.screenId === 4" />
    <CharaStatus :exp="this.exp" :love="this.love" :growth="this.growth" v-if="this.$store.state.screenId === 5" />
    <CharaFood :foods="foods" v-if="this.$store.state.screenId === 6" />
    <CharaPictures v-if="this.$store.state.screenId === 7" />
    <CharaFarewell v-if="this.$store.state.screenId === 8" />
    <GameSlot :point="this.point" v-if="this.$store.state.screenId === 9" />
    <GameHighAndLow :point="this.point" v-if="this.$store.state.screenId === 10" />
    <GameOmikuji :point="this.point" v-if="this.$store.state.screenId === 11" />
    <GameFoodShop :point="this.point" :foods="foods" v-if="this.$store.state.screenId === 12" />
  </div>
</template>

<script>
export default {
  props: ["unit", "exp", "love", "growth", "line", "point", "foods"],
  data() {
    return {

    };
  },
  mounted() {
  }
};
</script>