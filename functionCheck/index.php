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
    document.querySelector('#funcao-executada')
        && document.querySelector('#funcao-executada').remove();
    
    const div = criarElemento('div', {
        id:'funcao-executada',
        innerText: result ? 'Função executada: '+ result : ''
    });

    return div;
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

            root.append(
                funcaoExecutada(json.result)
            );
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

function criarElemento(tag, {id = '', type = '', innerText = '', name = ''} = {}){
    const element = document.createElement(tag);

    element.id = id;
    element.type = type;
    element.innerText = innerText;
    element.name = name;

    return element;
}
</script>