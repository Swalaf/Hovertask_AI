import { Image, Video, UploadCloud, X } from "lucide-react";
import {
  type DragEvent,
  type InputHTMLAttributes,
  useEffect,
  useRef,
  useState,
} from "react";
import { toast } from "sonner";
import cn from "../../utils/cn";

export default function MediaInput(
  props: Omit<
    InputHTMLAttributes<HTMLInputElement>,
    "type" | "accept" | "onChange" | "className"
  > & {
    maxFileSizeMB?: number;
    label?: string;
  },
) {
  let { maxLength, maxFileSizeMB = 20, label, ...rest } = props;
  const [draggedOver, setDraggedOver] = useState(false);
  const [filesLength, setFilesLength] = useState<number>(0);
  const inputRef = useRef<HTMLInputElement>(null);
  const [previewUrl, setPreviewUrl] = useState("");
  const [fileType, setFileType] = useState<"image" | "video" | null>(null);

  if (!maxLength) maxLength = Number.POSITIVE_INFINITY;

  useEffect(() => {
    if (inputRef.current?.files?.length) {
      const file = inputRef.current.files[0];
      const objectUrl = URL.createObjectURL(file);
      setPreviewUrl(objectUrl);
      setFileType(file.type.startsWith("video") ? "video" : "image");

      return () => URL.revokeObjectURL(objectUrl);
    }
  }, [filesLength]);

  function verifyMimeType(file: File) {
    return /^(image|video)\//.test(file.type);
  }

  function verifyFileSize(file: File) {
    const sizeMB = file.size / (1024 * 1024);
    return sizeMB <= maxFileSizeMB;
  }

  function handleDragOver(e: DragEvent<HTMLDivElement>) {
    e.preventDefault();
    setDraggedOver(true);
  }

  function handleDragOut(e: DragEvent<HTMLDivElement>) {
    e.preventDefault();
    setDraggedOver(false);
  }

  function handleDrop(e: DragEvent<HTMLDivElement>) {
    e.preventDefault();
    try {
      const files = e.dataTransfer?.files;
      if (!files?.length) return;

      const fileArr = Array.from(files);

      if (!fileArr.every(verifyMimeType))
        return toast.warning("Only images and videos are allowed.");
      if (fileArr.length > 5)
        return toast.error("Only a maximum of 5 files is allowed.");

      if (!fileArr.every(verifyFileSize))
        return toast.error(`Each file must be ≤ ${maxFileSizeMB} MB.`);

      if (inputRef.current) {
        inputRef.current.files = files as any;
        setFilesLength(files.length);
      }
    } finally {
      setDraggedOver(false);
    }
  }

  function handleChange(e: React.ChangeEvent<HTMLInputElement>) {
    const files = e.target.files;
    if (!files?.length) return toast.warning("Please select a media file.");

    if (files.length > maxLength!) {
      e.target.value = "";
      return toast.error(`Only a maximum of ${maxLength} files is allowed.`);
    }

    const file = files[0];

    if (!verifyMimeType(file))
      return toast.warning("Only images or videos are allowed.");
    if (!verifyFileSize(file))
      return toast.error(`Each file must be ≤ ${maxFileSizeMB} MB.`);

    setFilesLength(files.length);
    setPreviewUrl((prev) => {
      URL.revokeObjectURL(prev);
      return URL.createObjectURL(file);
    });
    setFileType(file.type.startsWith("video") ? "video" : "image");
  }

  function clearPreview() {
    setPreviewUrl("");
    setFilesLength(0);
    setFileType(null);
    if (inputRef.current) {
      inputRef.current.value = "";
    }
  }

  return (
    <div className="space-y-2">
      {label && (
        <label className="block text-sm font-semibold text-zinc-700">
          {label}
        </label>
      )}
      <div
        onKeyUp={() => inputRef.current?.click()}
        onClick={() => inputRef.current?.click()}
        onDragOver={handleDragOver}
        onDrop={handleDrop}
        onDragLeave={handleDragOut}
        className={cn(
          "relative aspect-video rounded-2xl border-2 border-dashed transition-all duration-300 overflow-hidden cursor-pointer group",
          draggedOver 
            ? "border-primary bg-primary/10 scale-[1.02] shadow-lg shadow-primary/20" 
            : "border-zinc-300 bg-zinc-50 hover:border-zinc-400 hover:bg-zinc-100 hover:shadow-md",
          filesLength && "border-solid border-zinc-200 bg-white"
        )}
      >
        <input
          ref={inputRef}
          onChange={handleChange}
          type="file"
          accept="image/*,video/*"
          name={fileType === "video" ? "video_path" : "file_path"}
          className="opacity-0 absolute inset-0 w-full h-full cursor-pointer z-20"
          {...rest}
          multiple={maxLength ? maxLength > 1 : false}
        />

        {/* Upload Content */}
        <div
          className={cn(
            "absolute inset-0 flex items-center justify-center flex-col gap-3 z-10 transition-all duration-300",
            filesLength ? "opacity-0 pointer-events-none" : "opacity-100"
          )}
        >
          {/* Animated icon container */}
          <div className={cn(
            "w-16 h-16 rounded-full flex items-center justify-center transition-all duration-300",
            draggedOver 
              ? "bg-primary/20 scale-110" 
              : "bg-zinc-200 group-hover:bg-zinc-300 group-hover:scale-105"
          )}>
            {draggedOver ? (
              <UploadCloud className="w-8 h-8 text-primary animate-bounce" />
            ) : (
              <>
                <Image className="w-5 h-5 text-zinc-400" />
                <Video className="w-5 h-5 text-zinc-400" />
              </>
            )}
          </div>
          
          <div className="text-center">
            <p className="text-sm font-medium text-zinc-700">
              {draggedOver ? "Drop your files here" : "Click or drag files to upload"}
            </p>
            <p className="text-xs text-zinc-500 mt-1">
              Supports images and videos up to {maxFileSizeMB}MB
            </p>
          </div>
        </div>

        {/* Preview Content */}
        {previewUrl && (
          <div className="absolute inset-0 flex items-center justify-center bg-zinc-50 animate-fadeIn">
            {fileType === "video" ? (
              <video
                src={previewUrl}
                controls
                className="max-h-full max-w-full object-contain"
              />
            ) : (
              <img
                src={previewUrl}
                className="max-h-full max-w-full object-contain"
                alt="Preview"
              />
            )}
            
            {/* Clear button */}
            <button
              type="button"
              onClick={(e) => {
                e.stopPropagation();
                clearPreview();
              }}
              className="absolute top-2 right-2 w-8 h-8 rounded-full bg-white shadow-lg flex items-center justify-center text-zinc-500 hover:text-red-500 hover:scale-110 transition-all duration-200 z-20"
            >
              <X className="w-4 h-4" />
            </button>
          </div>
        )}
      </div>

      {/* Upload limits */}
      <div className="flex items-center justify-between">
        <p className="text-xs text-zinc-500">
          Maximum {maxLength} file(s), up to {maxFileSizeMB} MB each
        </p>
        {filesLength > 0 && (
          <span className="text-xs font-medium text-primary">
            {filesLength} file(s) selected
          </span>
        )}
      </div>
    </div>
  );
}
