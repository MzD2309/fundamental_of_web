// 1. pow(x, n) — возведение в степень без Math.pow и оператора **
function pow(x, n) {
    if (!Number.isInteger(n) || n < 1) {
        throw new Error("Показатель степени n должен быть натуральным числом (n >= 1)");
    }

    let result = 1;
    for (let i = 0; i < n; i++) {
        result *= x;
    }
    return result;
}

// 2. gcd(a, b) — наибольший общий делитель (алгоритм Евклида)
function gcd(a, b) {
    a = Math.abs(Number(a));
    b = Math.abs(Number(b));

    if (!Number.isFinite(a) || !Number.isFinite(b)) {
        throw new Error("Аргументы должны быть числами");
    }

    if (!Number.isInteger(a) || !Number.isInteger(b) || a < 0 || b < 0) {
        throw new Error("Аргументы должны быть целыми неотрицательными числами");
    }

    // Обработка случая, когда оба нулевые: НОД(0, 0) не определён, вернём 0
    if (a === 0 && b === 0) return 0;

    while (b !== 0) {
        const temp = b;
        b = a % b;
        a = temp;
    }
    return a;
}

// 3. minDigit(x) — наименьшая цифра числа
function minDigit(x) {
    if (!Number.isInteger(x) || x < 0) {
        throw new Error("x должен быть целым неотрицательным числом");
    }

    const digits = String(x).split("");
    let min = 9;

    for (const ch of digits) {
        const d = Number(ch);
        if (d < min) min = d;
    }

    return min;
}

// 4. pluralizeRecords(n) — правильная форма слова "запись" для русского языка
function pluralizeRecords(n) {
    if (!Number.isInteger(n) || n < 0) {
        throw new Error("n должно быть целым неотрицательным числом");
    }

    const lastTwo = n % 100;
    const last = n % 10;

    let word;
    if (lastTwo >= 11 && lastTwo <= 14) {
        word = "записей"; // many
    } else if (last === 1) {
        word = "запись"; // one
    } else if (last >= 2 && last <= 4) {
        word = "записи"; // few
    } else {
        word = "записей"; // many
    }

    return `В результате выполнения запроса было найдено ${n} ${word}`;
}

// 5. fibb(n) — n-е число Фибоначчи (0 <= n <= 1000)
// Используем BigInt, чтобы корректно работать с большими индексами
function fibb(n) {
    if (!Number.isInteger(n) || n < 0 || n > 1000) {
        throw new Error("n должно быть целым числом в диапазоне 0..1000");
    }

    if (n === 0) return 0n;
    if (n === 1) return 1n;

    let prev = 0n; // F(0)
    let curr = 1n; // F(1)

    for (let i = 2; i <= n; i++) {
        const next = prev + curr;
        prev = curr;
        curr = next;
    }

    return curr;
}

// ====== Связь с HTML и обработчики кнопок ======

function setResult(id, text, isError = false) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = text;
    el.classList.toggle("result--error", isError);
}

window.addEventListener("DOMContentLoaded", () => {
    // pow(x, n)
    document.getElementById("pow-run").addEventListener("click", () => {
        const x = Number(document.getElementById("pow-x").value);
        const n = Number(document.getElementById("pow-n").value);
        try {
            const value = pow(x, n);
            setResult("pow-result", `pow(${x}, ${n}) = ${value}`);
        } catch (e) {
            setResult("pow-result", e.message, true);
        }
    });

    // gcd(a, b)
    document.getElementById("gcd-run").addEventListener("click", () => {
        const a = Number(document.getElementById("gcd-a").value);
        const b = Number(document.getElementById("gcd-b").value);
        try {
            const value = gcd(a, b);
            setResult("gcd-result", `gcd(${a}, ${b}) = ${value}`);
        } catch (e) {
            setResult("gcd-result", e.message, true);
        }
    });

    // minDigit(x)
    document.getElementById("minDigit-run").addEventListener("click", () => {
        const x = Number(document.getElementById("minDigit-x").value);
        try {
            const value = minDigit(x);
            setResult("minDigit-result", `Наименьшая цифра числа ${x} = ${value}`);
        } catch (e) {
            setResult("minDigit-result", e.message, true);
        }
    });

    // pluralizeRecords(n)
    document.getElementById("plural-run").addEventListener("click", () => {
        const n = Number(document.getElementById("plural-n").value);
        try {
            const phrase = pluralizeRecords(n);
            setResult("plural-result", phrase);
        } catch (e) {
            setResult("plural-result", e.message, true);
        }
    });

    // fibb(n)
    document.getElementById("fibb-run").addEventListener("click", () => {
        const n = Number(document.getElementById("fibb-n").value);
        try {
            const value = fibb(n); // BigInt
            setResult("fibb-result", `fibb(${n}) = ${value.toString()}`);
        } catch (e) {
            setResult("fibb-result", e.message, true);
        }
    });
});
