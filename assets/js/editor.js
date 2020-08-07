console.log('editor script loaded!!');
const blockStyle = {
  backgroundColor: '#900',
  color: '#fff',
  padding: '20px'
};
wp.blocks.registerBlockType('sunrise/page-header', {
  title: 'Page Header',
  icon: 'universal-access-alt',
  category: 'layout',
  example: {},

  edit() {
    return (
      /*#__PURE__*/
      React.createElement("div", {
        style: blockStyle
      }, "Hello World, step 1 (from the editor).")
    );
  },

  save() {
    return (
      /*#__PURE__*/
      React.createElement("div", {
        style: blockStyle
      }, "Hello World, step 1 (from the frontend).")
    );
  }

});