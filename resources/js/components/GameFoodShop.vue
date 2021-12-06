<template>
  <div class="message-game">
    <h3>▼ えさ販売店 現在{{ this.point }}ポイント</h3>

    <div class="game-index-food">
        <div
          v-for="food in this.foods"
          v-bind:key="food.food_id"
          v-bind:class="{active: store === (food.food_id - 1), strikethrough: point < food.price}"
          class="game-index-food-item"
        >
          <span v-text="food.name"></span>
          <span v-text="food.price"></span>
          <span>ポイント</span>
          <span v-text="food.quantity"></span>
          <span>個</span>
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
  mounted: function() {
    addEventListener("keyup", this.getSelecterSubCursor);
  },
  data() {
    return {
      store: this.$store.state.selectedSubCursor,
    };
  },
  methods: {
    getSelecterSubCursor(){
      this.store = this.$store.state.selectedSubCursor;
    }
  }
};
</script>