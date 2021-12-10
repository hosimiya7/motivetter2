<template>
  <div class="message-chara">
    <h3>▼ えさやり</h3>

    <div class="chara-index">
      <div class="chara-index-food">
        <div
          v-for="food in this.foods"
          v-bind:key="food.food_id"
          v-bind:class="{active: $store.state.selectedSubCursor === (food.food_id - 1), strikethrough: food.quantity <= 0}"
          class="chara-index-food-item"
        >
          <span v-text="food.name"></span>
          <input type="text" :id="`food_${food.food_id}`" placeholder="数値" />
          <span v-text="food.quantity"></span>
          <span>個</span>
        </div>
      </div>

      <div class="register" v-bind:class="{active: $store.state.selectedSubCursor === 4}">
        <h4>あげる</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["foods"],
  created: function() {},
  mounted: function() {
    addEventListener("keyup", this.getSelecterSubCursor);
  },
  data() {
    return {
      store: this.$store.state.selectedSubCursor,
    };
  },
  methods: {
    getSelecterSubCursor() {
      this.store = this.$store.state.selectedSubCursor;
    }
  }
};
</script>