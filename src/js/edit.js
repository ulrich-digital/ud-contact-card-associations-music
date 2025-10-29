import { __ } from "@wordpress/i18n";
import {
	useBlockProps,
	InspectorControls,
	MediaUpload,
	MediaUploadCheck,
	RichText,
	PanelColorSettings,
	withColors,
} from "@wordpress/block-editor";

import {
	PanelBody,
	ToggleControl,
	Button,
	TextControl,
} from "@wordpress/components";
import { useEffect } from "@wordpress/element";
import { create, edit, trash } from "@wordpress/icons";

function Edit({
	attributes,
	setAttributes,
	textColor,
	backgroundColor,
	setTextColor,
	setBackgroundColor,
}) {
	const {
		name,
description,
		contactPerson,
		address,
		phone,
		email,
		websiteUrl,
		websiteLabel,
		showImage,
		imageUrl,
		imageId,
	} = attributes;

	useEffect(() => {
		if (!imageUrl && window.udPersonalCardPlaceholder) {
			setAttributes({ imageUrl: window.udPersonalCardPlaceholder });
		}
	}, []);

	const isPlaceholder = imageUrl === window.udPersonalCardPlaceholder;

	const onSelectImage = (media) => {
		setAttributes({
			imageUrl: media.url,
			imageId: media.id,
		});
	};

	const removeImage = () => {
		setAttributes({
			imageUrl: window.udPersonalCardPlaceholder,
			imageId: null,
		});
	};

	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelColorSettings
					title={__("Farben", "ud")}
					initialOpen={true}
					colorSettings={[
						{
							value: textColor?.color,
							onChange: setTextColor,
							label: __("Textfarbe", "ud"),
						},
						{
							value: backgroundColor?.color,
							onChange: setBackgroundColor,
							label: __("Hintergrundfarbe", "ud"),
						},
					]}
				/>

				<PanelBody title={__("Darstellung", "ud")}>
					<ToggleControl
						label={__("Bild anzeigen", "ud")}
						checked={showImage}
						onChange={(value) =>
							setAttributes({ showImage: value })
						}
					/>
				</PanelBody>
			</InspectorControls>

			<div {...blockProps}>
				{showImage && imageUrl && (
					<div className="ud-contact-image-left">
						<div className="ud-contact-image-wrapper">
							<img
								src={imageUrl}
								alt={__("Bild", "ud")}
								className="ud-contact-image"
							/>
							<div className="ud-image-actions">
								<MediaUploadCheck>
									<MediaUpload
										onSelect={onSelectImage}
										allowedTypes={["image"]}
										render={({ open }) => (
											<Button
												onClick={open}
												icon={
													isPlaceholder
														? create
														: edit
												}
												label={
													isPlaceholder
														? __(
																"Bild hinzufügen",
																"ud",
														  )
														: __(
																"Bild ändern",
																"ud",
														  )
												}
												size="small"
											/>
										)}
									/>
								</MediaUploadCheck>

								{!isPlaceholder && (
									<Button
										onClick={removeImage}
										variant="secondary"
										icon={trash}
										label={__("Entfernen", "ud")}
										isDestructive
										size="small"
									/>
								)}
							</div>
						</div>
					</div>
				)}

				<div className="ud-contact-content">
					<div className="ud-contact-meta">
						<TextControl
							tagName="div"
							className="ud-contact-name"
							value={name}
							onChange={(value) => setAttributes({ name: value })}
							placeholder={__(
								"Name der Gruppe oder des Vereins",
								"ud",
							)}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
<TextControl
	tagName="div"
	className="ud-contact-description"
	value={description}
	onChange={(value) => setAttributes({ description: value })}
	placeholder={__("Beschreibung (optional)", "ud")}
	__next40pxDefaultSize={true}
	__nextHasNoMarginBottom={true}
/>

						
					</div>

					<div className="ud-contact-details">
						<TextControl
							tagName="div"
							className="ud-contact-person"
							value={contactPerson}
							onChange={(value) =>
								setAttributes({ contactPerson: value })
							}
							placeholder={__("Kontaktperson", "ud")}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
						<TextControl
							tagName="div"
							className="ud-contact-address"
							value={address}
							onChange={(value) =>
								setAttributes({ address: value })
							}
							placeholder={__("Adresse (Strasse, Ort)", "ud")}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
						<TextControl
							tagName="div"
							className="ud-contact-phone"
							value={phone}
							onChange={(value) =>
								setAttributes({ phone: value })
							}
							placeholder={__("Telefonnummer", "ud")}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
						<TextControl
							tagName="div"
							className="ud-contact-email"
							value={email}
							onChange={(value) =>
								setAttributes({ email: value })
							}
							placeholder={__("E-Mail-Adresse", "ud")}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
						<TextControl
							tagName="div"
							className="ud-contact-website"
							value={websiteUrl}
							onChange={(value) =>
								setAttributes({ websiteUrl: value })
							}
							placeholder={__("https://...", "ud")}
							allowedFormats={[]}
							__next40pxDefaultSize={true}
							__nextHasNoMarginBottom={true}
						/>
					</div>
				</div>
			</div>
		</>
	);
}

export default withColors("textColor", "backgroundColor")(Edit);
