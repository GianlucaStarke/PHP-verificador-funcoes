<div id="root"></div>

<script>
const root = document.querySelector('#root');

const inputFuncao = () => {
    const input = criarElemento('input');

    input.name = 'funcao';
    input.type = 'text';

    return input;
}

const botaoFuncao = () => {
    const button = criarElemento('button');

    button.type = 'submit';
    button.innerText = 'Executar';

    return button;
}

const formFuncao = () => {
    const form = criarElemento('form');

    form.addEventListener('submit', async function(e){
        try{
            const event = e || window.event;

            event.preventDefault();

            const res = await fetch('funcoes.php?funcao='+ this.funcao.value);

            if(!res.ok){
                throw new Error('HTTP ERROR: '+ res.status);
            }

            const json = await res.json();

            if(json.error){
                throw new Error(json.error);
            }

            console.log(json.result);
        }
        catch(rej){
            alert(rej);
            console.error(rej);
        }
    });

    form.append(
        inputFuncao(),
        botaoFuncao()
    );

    return form
}

root.append(
    formFuncao()
);

function criarElemento(tag){
    return document.createElement(tag);
}
</script>