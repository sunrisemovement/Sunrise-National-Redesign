console.log('editor script loaded!!');

const blockStyle = {
    backgroundColor: '#900',
    color: '#fff',
    padding: '20px',
};
 
wp.blocks.registerBlockType( 'sunrise/page-header', {
    title: 'Page Header',
    icon: 'universal-access-alt',
    category: 'layout',
    example: {},
    edit() {
        return <div style={ blockStyle }>Hello World, step 1 (from the editor).</div>;
    },
    save() {
        return <div style={ blockStyle }>Hello World, step 1 (from the frontend).</div>;
    },
} );