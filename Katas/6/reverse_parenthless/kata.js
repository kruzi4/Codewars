function reverseParentheses(s) {
    while (s.match(/\((\w+)\)/)) {
        let match = s.match(/\((\w+)\)/)
        let reversed = match[1].split('').reverse().join('')
        s = s.replace(match[0], reversed)
    }

    return s;
}

console.log(reverseParentheses('a(bcdefghijkl(mno)p)q'))