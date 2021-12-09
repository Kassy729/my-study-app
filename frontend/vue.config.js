module.exports = {
  transpileDependencies: ["vuetify"],

  devServer: {
    proxy: {
      "/api": {
        target: "http://18.181.162.146:8000/",
        changeOrigin: true,
        // pathRewrite: {
        //   "^/api": "",
        // },
      },
    },
    disableHostCheck: true,
    // port: 8000,
    // public: "0.0.0.0:8000",
  },
};
