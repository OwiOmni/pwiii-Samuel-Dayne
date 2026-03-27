# pwiii-Samuel-Dayne
Programação Web III por Professor João Siles

# React Tic-Tac-Toe

Um guia rápido do tutorial oficial do React construindo um jogo da velha.

---

## Overview

Neste projeto você aprende:

- Componentes reutilizáveis  
- Estado com useState  
- Eventos (cliques)  
- Organização de código  

---

## Componentes

### Square

Representa um botão do tabuleiro.

```js
function Square({ value, onClick }) {
  return <button onClick={onClick}>{value}</button>;
}
Board

Gerencia os 9 quadrados.

const [squares, setSquares] = useState(Array(9).fill(null));
Interação
Clique

Atualiza o estado ao clicar:

function handleClick(i) {
  const nextSquares = squares.slice();
  nextSquares[i] = "X";
  setSquares(nextSquares);
}
Alternância de jogador
const [xIsNext, setXIsNext] = useState(true);

nextSquares[i] = xIsNext ? "X" : "O";
setXIsNext(!xIsNext);
Lógica do jogo
Verificar vencedor
function calculateWinner(squares) {
  const lines = [
    [0,1,2],[3,4,5],[6,7,8],
    [0,3,6],[1,4,7],[2,5,8],
    [0,4,8],[2,4,6]
  ];

  for (let [a, b, c] of lines) {
    if (
      squares[a] &&
      squares[a] === squares[b] &&
      squares[a] === squares[c]
    ) {
      return squares[a];
    }
  }

  return null;
}
Status do jogo
const winner = calculateWinner(squares);

const status = winner
  ? "Winner: " + winner
  : "Next player: " + (xIsNext ? "X" : "O");
Lifting State Up

O estado é movido para o componente Game.

Centraliza a lógica
Permite controle total do jogo
Histórico (Time Travel)
const [history, setHistory] = useState([
  Array(9).fill(null)
]);
Cada jogada salva um estado
Permite voltar no tempo
Navegação
function jumpTo(move) {
  setStepNumber(move);
  setXIsNext(move % 2 === 0);
}
Resultado
Jogo funcional
Alternância de jogadores
Verificação de vencedor
Histórico de jogadas
Conceitos
useState
Props
Imutabilidade
Componentização
Lifting State Up