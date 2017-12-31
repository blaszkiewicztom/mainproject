var React = require('react');
var ReactDOM = require('react-dom');



class Test extends React.Component {

    render(){
        const name = 'mariusz';
        return (
            <div>
                <strong>Licznik kliknięć: 5 {name}</strong>
            </div>
        )
    }

}

ReactDOM.render(
    <Test/>,
    document.getElementById('test')
);







