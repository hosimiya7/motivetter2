export default class HighAndLow {

    randomNum
    nextNum
    point
    start
    startButton

    constructor() {
        this.randomNum = this.setRandomNumber()
        this.nextNum = this.setRandomNumber()
        this.point = 1
        this.start = 0
    }

    setRandomNumber() {
        return Math.floor(Math.random() * 13) + 1
    }

    startGame() {
        this.start = 1
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
        this.point = 'コインが0になりました'
        this.start = 0
    }

    resetPoint() {
        this.point = 1
    }

    clearNumber() {
        document.getElementById("number_highAndLow").innerHTML = 'ここに数値が出ます'
    }
}
