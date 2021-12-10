export default class HighAndLow {

    randomNum
    nextNum
    point
    start
    startButton

    PLAYINGGAME = 1
    NOTPLAYINGGAME = 0

    constructor() {
        this.randomNum = this.setRandomNumber()
        this.nextNum = this.setRandomNumber()
        this.point = 1
        this.start = this.NOTPLAYINGGAME
    }

    setGame() {
        this.point = 1
        this.start = this.NOTPLAYINGGAME
    }

    setRandomNumber() {
        return Math.floor(Math.random() * 13) + 1
    }

    startGame() {
        this.point = 1
        this.start = this.PLAYINGGAME
        this.setNumber()
        this.setPoint()
    }

    playGame() {
        this.getNextnumber()
        this.setNumber()
        this.setPoint()
    }

    resetGame() {
        this.resetPoint()
        this.clearNumber()
        this.setPoint()
    }

    setNumber() {
        document.getElementById("number_highAndLow").innerHTML = this.randomNum
    }

    setPoint() {
        document.getElementById("point_highAndLow").innerHTML = this.point
    }

    getNextnumber() {
        this.randomNum = this.nextNum
        this.nextNum = this.setRandomNumber()
    }

    getPoint() {
        this.point *= 2
    }

    lostPoint() {
        this.point = 0
        this.start = this.NOTPLAYINGGAME
    }

    resetPoint() {
        this.point = this.NOTPLAYINGGAME
    }

    clearNumber() {
        document.getElementById("number_highAndLow").innerHTML = '最大値は13です。次の数値の大小を予測してください。'
    }

    isPlayingGame() {
        this.start === this.PLAYINGGAME
    }

}
