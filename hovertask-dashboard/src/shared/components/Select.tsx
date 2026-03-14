import {
  Autocomplete,
  AutocompleteItem,
  type AutocompleteProps,
  Select,
  SelectItem,
  type SelectProps,
} from "@heroui/react";
import cn from "../../utils/cn";

type Option = { key: string; label: string };

type CustomSelectProps = Omit<SelectProps, "children" | "onChange"> &
  Omit<AutocompleteProps, "children" | "onChange"> & {
    options: Option[];
    isAutoComplete?: boolean;
    errorMessage?: string;
    helperText?: string;
    onChange?: (value: string) => void;
  };

export default function CustomSelect(props: CustomSelectProps) {
  const { isAutoComplete, options, label, className, onChange, errorMessage, helperText, ...rest } = props;
  const hasError = !!errorMessage;

  return (
    <div className="space-y-1.5">
      {label && (
        <label className="text-sm font-semibold text-zinc-700" htmlFor={props.id}>
          {label}
        </label>
      )}

      {isAutoComplete ? (
        <Autocomplete
          labelPlacement="outside"
          {...rest}
          onInputChange={(value) => {
            onChange?.(value);
          }}
          className={cn(
            "[&_div[data-slot='main-wrapper']]:border-2 [&_div[data-slot='main-wrapper']]:bg-white [&_div[data-slot='main-wrapper']]:border-zinc-200 [&_div[data-slot='main-wrapper']]:rounded-xl [&_div[data-slot='main-wrapper']]:transition-all [&_div[data-slot='main-wrapper']]:hover:border-zinc-300 [&_div[data-slot='main-wrapper']]:hover:shadow-md",
            "[&_div[data-slot='main-wrapper'].is-focused]:border-primary [&_div[data-slot='main-wrapper'].is-focused]:shadow-lg [&_div[data-slot='main-wrapper'].is-focused]:ring-4 [&_div[data-slot='main-wrapper'].is-focused]:ring-primary/20",
            hasError && "[&_div[data-slot='main-wrapper']]:border-red-400 [&_div[data-slot='main-wrapper']]:bg-red-50 [&_div[data-slot='main-wrapper'].is-focused]:ring-red-500/20",
            "[&_div[data-slot='listboxWrapper']]:min-w-full [&_div[data-slot='listbox']]:bg-white [&_div[data-slot='listbox']]:rounded-xl [&_div[data-slot='listbox']]:shadow-xl [&_div[data-slot='listbox']]:border [&_div[data-slot='listbox']]:border-zinc-100",
            className,
          )}
        >
          {options.map((type) => (
            <AutocompleteItem key={type.key}>{type.label}</AutocompleteItem>
          ))}
        </Autocomplete>
      ) : (
        <Select
          labelPlacement="outside"
          {...rest}
          onSelectionChange={(keys) => {
            const value = Array.from(keys)[0] as string;
            onChange?.(value);
          }}
          className={cn(
            "[&_button]:border-2 [&_button]:bg-white [&_button]:border-zinc-200 [&_button]:rounded-xl [&_button]:transition-all [&_button]:hover:border-zinc-300 [&_button]:hover:shadow-md",
            "[&_button.is-focused]:border-primary [&_button.is-focused]:shadow-lg [&_button.is-focused]:ring-4 [&_button.is-focused]:ring-primary/20",
            hasError && "[&_button]:border-red-400 [&_button]:bg-red-50 [&_button.is-focused]:ring-red-500/20",
            "[&_div[data-slot='listboxWrapper']]:min-w-full [&_div[data-slot='listbox']]:bg-white [&_div[data-slot='listbox']]:rounded-xl [&_div[data-slot='listbox']]:shadow-xl [&_div[data-slot='listbox']]:border [&_div[data-slot='listbox']]:border-zinc-100",
            className,
          )}
        >
          {options.map((type) => (
            <SelectItem key={type.key}>{type.label}</SelectItem>
          ))}
        </Select>
      )}

      {(errorMessage || helperText) && (
        <p className={cn(
          "text-sm font-medium transition-all duration-300",
          hasError ? "text-red-500" : "text-zinc-500"
        )}>
          {errorMessage || helperText}
        </p>
      )}
    </div>
  );
}
