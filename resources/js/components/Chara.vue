<template>
    <div class="message-chara">

        <h3>▼ キャラクター管理</h3>

        <div class="chara-index">
            <div class="chara-index-first">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">ステータス</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">えさやり</span>
            </div>
            <div class="chara-index-second">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">キャラ図鑑</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">おわかれ</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    created: function() {
    },
    mounted: function() {
    },
    data() {
        return {
        }
    },
    methods: {
    }
}
</script>