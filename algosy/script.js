function fizzbuzz(num) {
    for(i=1; i<=num; i++) {
        if(i % 3 === 0 && i % 5 === 0) {
            console.log('fizzbuzz')
        } else {
            if(i % 3 === 0) {
                console.log('fizz')
                continue;
            }
            if(i % 5 === 0) {
                console.log('buzz')
                continue;
            }
            console.log(i)
               
        }
    }

}

// fizzbuzz(15)


function fizzbuzzSum(num) {
    let sum = 0;
    for(i=1; i<=num; i++) {
        if(i % 3 === 0 || i % 5 === 0) {
            sum += i;
        }
    }
    console.log(sum);
}


// fizzbuzzSum(999)


function sumEvenFibs(n1=1, n2=2, max) {
    if (n2 > max) return 0
    let add = (n2 % 2 === 0) ? n2 : 0
    return add + sumEvenFibs(n2, n1 + n2, max)
}

console.log(sumEvenFibs(1,2,4000000))