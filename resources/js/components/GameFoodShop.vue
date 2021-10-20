<template>
    <div class="message-game">

        <h3>▼ えさ販売店 現在()ポイント</h3>

        <div class="game-index">
            <div class="game-index-first">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 0}">スロット</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 1}">ハイ&amp;ロー</span>
            </div>
            <div class="game-index-second">
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 2}">おみくじ</span>
                <span v-bind:class="{active: this.$store.state.selectedSubCursor === 3}">えさ販売店</span>
            </div>
        </div>

    </div>
</template>