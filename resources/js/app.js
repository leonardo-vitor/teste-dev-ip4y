const cpfInput = document.querySelector('.mask-cpf');
cpfInput.addEventListener('input', maskCpf, false);

function maskCpf(e) {
    let cpfNumber = e.target.value;

    e.target.value = cpfNumber.replace(/\D/g, '')
        .replace(/^(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})/, '$1-$2')
        .replace(/(-\d{2})\d+?$/, '$1');
}
