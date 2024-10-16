import React, { useEffect, useState } from 'react';
import Form from './Form';

const App: React.FC = () => {
    const [label, setLabel] = useState('');

    const fetchData = async () => {
        try {
            const response = await fetch(`${window.location.origin}/wp-json/wp-plugin-template/example`);
            const data = await response.json();
            if (data.label) {
                setLabel(data.label);
            }
        } catch (error) {
            console.error('Erro ao buscar os dados: ', error);
        }
    };

    const handleLabelChange = (newLabel: string) => {
        setLabel(newLabel);
    };

    useEffect(() => {
        fetchData();
    }, []);

    return (
        <div className='bg-white rounded-md m-4 p-4'>
            <h1>React Settings Page</h1>
            <p>Our react settings page is now ready.</p>
            <Form label={label} onLabelChange={handleLabelChange} />
        </div>
    );
};

export default App;
