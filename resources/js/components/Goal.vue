<template>
    <div class="message-goal">

    <h3>▼ 目標入力・変更</h3>

        <div class="small-goal">
            <div class="small_goal_content" v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">
                <span>目標:</span>
                <input type="text" name="goal" id="goal" placeholder="プログラミング">
            </div>
            <div class="small-goal-number" v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">
                <span>数値:</span>
                <input type="text" name="number" id="number" placeholder="3">
            </div>
            <div class="small-goal-unit" v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">
                <span>単位:</span>
                <input type="text" name="unit" id="unit" placeholder="時間">
            </div>
            <div class="register" v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">
                <h4>登録</h4>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created: function() {
    },
    data() {
        return {
            goal: null,
            number: null,
            unit: null,
        }
    },
    methods: {

    }
}
</script>