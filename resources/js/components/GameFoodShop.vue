<template>
  <div class="message-game">
    <h3>▼ えさ販売店 現在{{ this.$store.state.shopPoint }}ポイント</h3>

    <div class="game-index">
      <div class="game-index-first">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0, strikethrough: this.$store.state.shopPoint < 50}">
          いちご
          <span class="margin-none" v-text="this.$store.state.foods[1]"></span>個
        <span class="margin-none">50ポイント</span>
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1, strikethrough: this.$store.state.shopPoint < 60}">
          おもち
          <span class="margin-none" v-text="this.$store.state.foods[2]"></span>個
        <span class="margin-none">60ポイント</span>
        </span>
      </div>
      <div class="game-index-second">
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2, strikethrough: this.$store.state.shopPoint < 100}">
          めろん
          <span class="margin-none" v-text="this.$store.state.foods[3]"></span>個
        <span class="margin-none">100ポイント</span>
        </span>
        <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3, strikethrough: this.$store.state.shopPoint < 20}">
          はっぱ
          <span class="margin-none" v-text="this.$store.state.foods[4]"></span>個
        <span class="margin-none">20ポイント</span>
        </span>
      </div>
    </div>
  </div>
</template>