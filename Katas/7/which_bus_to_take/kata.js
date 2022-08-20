function whichBusToTake(busesColors, goingToSchool) {
    let validBlue
    for (let [index, busesColor] of Object.entries(busesColors)) {
        let isGoingToSchool = goingToSchool[index]
        let isBlue = busesColor === 'blue'

        if (validBlue === undefined && isBlue && isGoingToSchool) {
            validBlue = +index
        }

        if (!isBlue && isGoingToSchool) {
            return +index
        }
    }

    return validBlue;
}

busesColors = ["red","red","red","red","red","red","red","red","red","red","red"]
goingToSchool = [false,false,false,false,false,true,false,false,false,false,false]

console.log(whichBusToTake(busesColors,
    goingToSchool))