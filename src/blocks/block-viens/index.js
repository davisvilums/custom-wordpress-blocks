import "./style.scss";

const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;

registerBlockType("custom-blocks/block-viens", {
	title: "Block Viens",
	icon: "star-half",
	category: "common",
	attributes: {
		content: {
			type: "string",
			source: "html",
			selector: "p",
		},
	},
	edit: ({ attributes, setAttributes, className }) => {
		return (
			<div>
				Test text tam taram
				<RichText
					tagName="p"
					className={className}
					value={attributes.content}
					onChange={(content) => setAttributes({ content })}
				/>
			</div>
		);
	},
	save: ({ attributes }) => {
		return <RichText.Content tagName="p" value={attributes.content} />;
	},
});
