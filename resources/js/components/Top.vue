<template>
    <div class="wrapper">
        <h1>もちべった～～</h1>
        <div class="main-wrapper">
            <div class="flex">
                <div class="command">
                    <Commands></Commands>
                </div>
                <div class="goal">
                    <span>{{ goals.number }}</span><span>{{ goals.unit }}</span><span>{{ goals.goal }}</span>
                </div>
                <div class="status">
                    <ul>
                        <li>
                            名前：{{ characters.character_template.name }}
                        </li>
                        <li>
                            現在の経験値：{{ characters.exp }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="char">
                <MyCanvas></MyCanvas>
                <!-- （ここにキャラクターが入ります） -->
            </div>
            <div class="message">
                <Message></Message>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
    import MyCanvas from './MyCanvas.vue'
    import Commands from './Commands.vue'
    export default {
        components: {
            MyCanvas,
            Commands
        },
        data() {
            return{
                goals: [], //データ格納
                characters: [],
            }
        },
        mounted() {
            // ページ遷移挟まないと表示されない
            window.axios.get('/api/goal/show')
            .then(response =>{
                this.goals = response['data'];
            })
            .catch(function (error) {
                console.log(error);
            });

            window.axios.get('/api/character/show')
            .then(response =>{
                this.characters = response['data'];
                console.log(this.characters)
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
</script>