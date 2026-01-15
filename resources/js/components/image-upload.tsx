import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Image as ImageIcon, Upload, X } from 'lucide-react';
import React, { useCallback, useState } from 'react';
import { useDropzone } from 'react-dropzone';

interface ImageUploadProps {
	files: File[];
	existingImages: Array<{
		id: number;
		name: string;
		file_name: string;
		mime_type: string;
		size: number;
		url: string;
	}>;
	imagesToDelete: number[];
	onFilesChange: (files: File[]) => void;
	onRemoveExisting: (imageId: number) => void;
	onRemoveFile: (index: number) => void;
	className?: string;
}

export default function ImageUpload({
	files,
	existingImages,
	imagesToDelete,
	onFilesChange,
	onRemoveExisting,
	onRemoveFile,
	className,
}: ImageUploadProps) {
	const [previews, setPreviews] = useState<string[]>([]);

	const onDrop = useCallback(
		(acceptedFiles: File[]) => {
			const newFiles = [...files, ...acceptedFiles];
			onFilesChange(newFiles);

			// Create previews for new files
			const newPreviews = acceptedFiles.map((file) =>
				URL.createObjectURL(file),
			);
			setPreviews((prev) => [...prev, ...newPreviews]);
		},
		[files, onFilesChange],
	);

	const { getRootProps, getInputProps, isDragActive } = useDropzone({
		onDrop,
		accept: {
			'image/*': ['.jpeg', '.jpg', '.png', '.gif', '.webp'],
		},
		multiple: true,
	});

	const handleRemoveFile = (index: number) => {
		const newFiles = files.filter((_, i) => i !== index);
		onFilesChange(newFiles);

		// Clean up preview URL
		URL.revokeObjectURL(previews[index]);
		setPreviews((prev) => prev.filter((_, i) => i !== index));
	};

	const handleRemoveExisting = (imageId: number) => {
		onRemoveExisting(imageId);
	};

	// Clean up all preview URLs on unmount
	React.useEffect(() => {
		return () => {
			previews.forEach((url) => {
				URL.revokeObjectURL(url);
			});
		};
	}, [previews]);

	return (
		<div className={cn('space-y-4', className)}>
			{/* Dropzone */}
			<div
				{...getRootProps()}
				className={cn(
					'cursor-pointer rounded-lg border-2 border-dashed border-black/20 p-6 text-center transition-colors hover:border-black/40 dark:border-white/20 dark:hover:border-white/40',
					isDragActive && 'border-primary bg-primary/20',
				)}
			>
				<input {...getInputProps()} />
				<div className="flex flex-col items-center gap-2">
					{isDragActive ? (
						<Upload className="h-8 w-8 text-primary" />
					) : (
						<ImageIcon className="h-8 w-8 text-foreground" />
					)}
					<div className="text-sm text-foreground">
						{isDragActive
							? 'Drop images here...'
							: 'Drag & drop images here, or click to select'}
					</div>
					<div className="text-xs text-foreground/20">
						Supported formats: JPG, PNG, GIF, WebP
					</div>
				</div>
			</div>

			{/* Selected Files */}
			{files.length > 0 && (
				<div>
					<h4 className="text-sm font-medium">
						New Images to Upload
					</h4>
					<div className="mt-2 grid grid-cols-2 gap-2 md:grid-cols-4">
						{files.map((file, index) => (
							<div
								key={`${file.name}-${index}`}
								className="group relative"
							>
								<img
									src={previews[index]}
									alt={file.name}
									className="h-20 w-full rounded border object-cover"
								/>
								<Button
									type="button"
									variant="destructive"
									size="sm"
									className="absolute -top-2 -right-2 h-6 w-6 rounded-full p-0 opacity-0 transition-opacity group-hover:opacity-100"
									onClick={() => handleRemoveFile(index)}
								>
									<X className="h-3 w-3" />
								</Button>
								<div className="bg-opacity-50 absolute right-0 bottom-0 left-0 truncate rounded-b bg-black p-1 text-xs text-white">
									{file.name}
								</div>
							</div>
						))}
					</div>
				</div>
			)}

			{/* Existing Images */}
			{existingImages.length > 0 && (
				<div>
					<h4 className="text-sm font-medium">Existing Images</h4>
					<div className="mt-2 grid grid-cols-2 gap-2 md:grid-cols-4">
						{existingImages.map((image) => {
							const isMarkedForDeletion = imagesToDelete.includes(
								image.id,
							);
							return (
								<div key={image.id} className="group relative">
									<img
										src={image.url}
										alt={image.name}
										className={cn(
											'h-20 w-full rounded border object-cover',
											isMarkedForDeletion &&
												'opacity-50 grayscale',
										)}
									/>
									<Button
										type="button"
										variant={
											isMarkedForDeletion
												? 'default'
												: 'destructive'
										}
										size="sm"
										className="absolute -top-2 -right-2 h-6 w-6 rounded-full p-0 opacity-0 transition-opacity group-hover:opacity-100"
										onClick={() =>
											handleRemoveExisting(image.id)
										}
									>
										{isMarkedForDeletion ? (
											<div className="h-3 w-3 rounded-full bg-white" />
										) : (
											<X className="h-3 w-3" />
										)}
									</Button>
									<div className="bg-opacity-50 absolute right-0 bottom-0 left-0 truncate rounded-b bg-black p-1 text-xs text-white">
										{image.name}
									</div>
									{isMarkedForDeletion && (
										<div className="absolute inset-0 flex items-center justify-center">
											<span className="rounded bg-red-500 px-2 py-1 text-xs text-white">
												Will be removed
											</span>
										</div>
									)}
								</div>
							);
						})}
					</div>
				</div>
			)}
		</div>
	);
}
