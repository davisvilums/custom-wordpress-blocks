const path = require("path");
const fs = require("fs");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

function getEntryPoints() {
	const blocksDir = path.resolve(__dirname, "src/blocks");
	const blockFolders = fs.readdirSync(blocksDir).filter((file) => {
		return fs.statSync(path.join(blocksDir, file)).isDirectory();
	});

	const entryPoints = {};
	blockFolders.forEach((folder) => {
		entryPoints[folder] = path.resolve(blocksDir, folder, "index.js");
	});

	return entryPoints;
}

module.exports = {
	entry: getEntryPoints(),
	output: {
		path: path.resolve(__dirname, "build/blocks"),
		filename: "[name]/index.js",
	},
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: "babel-loader",
					options: {
						presets: [
							"@babel/preset-env",
							"@babel/preset-react", // JSX support added
						],
					},
				},
			},
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
			},
		],
	},
	plugins: [
		new MiniCssExtractPlugin({
			filename: "[name]/style.css",
		}),
	],
};
