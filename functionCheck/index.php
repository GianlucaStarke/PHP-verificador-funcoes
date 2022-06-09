<div id="root"></div>

<script>
const root = document.querySelector('#root');

const inputFuncao = () => createHTMLElement('input', {
    name: 'funcao',
    type: 'text'
});

const botaoFuncao = () => createHTMLElement('button', {
    type: 'submit',
    innerText: 'Executar'
});

const funcaoExecutada = result => {
    const elemento = document.querySelector('#funcao-executada');
    
    if(elemento){
        elemento.innerText = result ? 'Função executada: '+ result : '';
    }
    else{
        return createHTMLElement('div', {
            id:'funcao-executada'
        });
    }
}

const formFuncao = () => createHTMLElement('form', {
    appendChildren: [
        inputFuncao(),
        botaoFuncao()
    ],
    onsubmit: async function(e){
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
    }
});

root.append(
    formFuncao(),
    funcaoExecutada()
);

function createHTMLElement(tag, props = {}){
    const element = document.createElement(tag);

    Object.entries(props).map(([prop, value]) => element[prop] = value);

	Array.isArray(props.classes)
	&& props.classes.map(classe => element.classList.add(classe));

	Array.isArray(props.appendChildren)
	&& props.appendChildren.map(child => element.append(child));

	Array.isArray(props.prependChildren)
	&& props.prependChildren.map(child => element.prepend(child));

	return element;
}
</script>