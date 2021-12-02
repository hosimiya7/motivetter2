<template>
  <div class="message-game">
    <h3>▼ えさ販売店 現在{{ this.point }}ポイント</h3>

    <div class="game-index">
      <div class="game-index-first">
        <span
          v-bind:class="{active: this.$store.state.selectedSubCursor === 0, strikethrough: this.point < 50}"
        >
          いちご
          <span class="margin-none">50ポイント</span>
          (
          <span class="margin-none" v-if="this.foods[0] === undefind" v-text="0"></span>
          <span class="margin-none" v-else v-text="this.foods[0].quantity"></span>個)
        </span>
        <span
          v-bind:class="{active: this.$store.state.selectedSubCursor === 1, strikethrough: this.point < 60}"
        >
          おもち
          <span class="margin-none">60ポイント</span>
          (
          <span class="margin-none" v-if="this.foods[1] === undefind" v-text="0"></span>
          <span class="margin-none" v-else v-text="this.foods[1].quantity"></span>個)
        </span>
      </div>
      <div class="game-index-second">
        <span
          v-bind:class="{active: this.$store.state.selectedSubCursor === 2, strikethrough: this.point < 100}"
        >
          めろん
          <span class="margin-none">100ポイント</span>
          (
           <span class="margin-none" v-if="this.foods[2] === undefind" v-text="0"></span>
          <span class="margin-none" v-else v-text="this.foods[2].quantity"></span>個)
        </span>
        <span
          v-bind:class="{active: this.$store.state.selectedSubCursor === 3, strikethrough: this.point < 20}"
        >
          はっぱ
          <span class="margin-none">20ポイント</span>
          (
           <span class="margin-none" v-if="this.foods[3] === undefind" v-text="0"></span>
          <span class="margin-none" v-else v-text="this.foods[3].quantity"></span>個)
        </span>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["point", "foods"],
  created: function() {
    console.log(this.foods)
  },
  data() {
    return {};
  },
  methods: {}
};
</script>