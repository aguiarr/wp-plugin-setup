import React from 'react';

const Form: React.FC<{ label: string; onLabelChange: (label: string) => void; }> = ({ label, onLabelChange }) => {
    const sendPost = async (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();

        const data = { label };

        try {
            const response = await fetch(`${window.location.origin}/wp-json/wp-plugin-template/example`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            });

            if (!response.ok) {
                throw new Error('Erro ao enviar os dados');
            }

            const responseData = await response.json();
            if (responseData.status === 'success') {
                window.location.reload();
            }
        } catch (error) {
            console.error('Erro ao enviar a requisição:', error);
        }
    };

    return (
        <form onSubmit={sendPost} className='flex gap-2 mb-4'>
            <input
                type="text"
                name='label'
                value={label}
                onChange={(e) => onLabelChange(e.target.value)}
            />
            <button className='bg-black h-8 w-20 rounded-sm text-white' type="submit">Save</button>
        </form>
    );
};


export default Form;
