import { Button } from '@/components/ui/button';
import { cn } from '@/lib/utils';
import { Image as ImageIcon, Upload, X } from 'lucide-react';
import React, { useCallback, useState } from 'react';
import { useDropzone } from 'react-dropzone';

interface SingleImageUploadProps {
	file: File | null;
	existingImage?: {
		id: number;
		name: string;
		file_name: string;
		mime_type: string;
		size: number;
		url: string;
	};
	onFileChange: (file: File | null) => void;
	className?: string;
	label?: string;
	showRemove?: boolean;
}

export default function SingleImageUpload({
	file,
	existingImage,
	onFileChange,
	className,
	label = 'Upload Image',
	showRemove = true,
}: SingleImageUploadProps) {
	const [preview, setPreview] = useState<string | null>(null);

	const onDrop = useCallback(
		(acceptedFiles: File[]) => {
			const selectedFile = acceptedFiles[0];
			if (selectedFile) {
				onFileChange(selectedFile);
				setPreview(URL.createObjectURL(selectedFile));
			}
		},
		[onFileChange],
	);

	const { getRootProps, getInputProps, isDragActive } = useDropzone({
		onDrop,
		accept: {
			'image/*': ['.jpeg', '.jpg', '.png', '.gif', '.webp'],
		},
		multiple: false,
	});

	const handleRemove = () => {
		onFileChange(null);
		setPreview(null);
	};

	// Create preview URL when file prop changes
	React.useEffect(() => {
		if (file && !preview) {
			setPreview(URL.createObjectURL(file));
		}
	}, [file, preview]);

	// Clean up preview URL on unmount
	React.useEffect(() => {
		return () => {
			if (preview) {
				URL.revokeObjectURL(preview);
			}
		};
	}, [preview]);

	const displayImage = preview || existingImage?.url;

	return (
		<div className={cn('space-y-2', className)}>
			{/* Dropzone */}
			<div
				{...getRootProps()}
				className={cn(
					'cursor-pointer rounded-lg border-2 border-dashed border-black/20 p-6 text-center transition-colors hover:border-black/50 dark:border-white/20 dark:hover:border-white/40',
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
						{isDragActive ? 'Drop image here...' : label}
					</div>
					<div className="text-xs text-muted-foreground">
						Supported formats: JPG, PNG, GIF, WebP
					</div>
				</div>
			</div>

			{/* Preview */}
			{displayImage && (
				<div className="group relative">
					<img
						src={displayImage}
						alt="Preview"
						className="h-32 w-full rounded border object-cover"
					/>
					{showRemove && (
						<Button
							type="button"
							variant="destructive"
							size="sm"
							className="absolute -top-2 -right-2 h-6 w-6 rounded-full p-0 opacity-0 transition-opacity group-hover:opacity-100"
							onClick={handleRemove}
						>
							<X className="h-3 w-3" />
						</Button>
					)}
					<div className="bg-opacity-50 absolute right-0 bottom-0 left-0 truncate rounded-b bg-black p-1 text-xs text-white">
						{file
							? file.name
							: existingImage?.name || 'Current image'}
					</div>
				</div>
			)}
		</div>
	);
}
