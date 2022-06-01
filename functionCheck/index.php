<div id="root"></div>

<script>
const root = document.querySelector('#root');

const inputFuncao = () => criarElemento('input', {
    name: 'funcao',
    type: 'text'
});

const botaoFuncao = () => criarElemento('button', {
    type: 'submit',
    innerText: 'Executar'
});

const funcaoExecutada = (result) => {
    const elemento = document.querySelector('#funcao-executada');
    
    if(elemento){
        elemento.innerText = result ? 'Função executada: '+ result : '';
    }
    else{
        return criarElemento('div', {
            id:'funcao-executada'
        });
    }
}

const formFuncao = () => {
    const form = criarElemento('form');

    form.addEventListener('submit', async function(e){
        try{
            const event = e || window.event;

            event.preventDefault();

            funcaoExecutada();

            const res = await fetch('funcoes.php?funcao='+ this.funcao.value);

            if(!res.ok){
                throw new Error('HTTP ERROR: '+ res.status);
            }

            const json = await res.json();

            if(json.error){
                throw new Error(json.error);
            }

            funcaoExecutada(json.result);
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
    formFuncao(),
    funcaoExecutada()
);

function criarElemento(tag, attr = {}){
    const element = document.createElement(tag);

    Object.entries(attr).map(([attr, value]) => element.setAttribute(attr, value));
    element.innerText = attr.innerText ? attr.innerText : '';

    return element;
}
</script>