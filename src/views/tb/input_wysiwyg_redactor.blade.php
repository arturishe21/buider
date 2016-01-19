<textarea id="{{$name}}-wysiwyg"
 toolbar = "{{$toolbar ? : "fullscreen, bold, italic, underline, strikeThrough, subscript, superscript, fontFamily, fontSize,  color,
  emoticons, inlineStyle, paragraphStyle,  paragraphFormat, align, formatOL, formatUL, outdent, indent, quote, insertHR,
  insertLink, insertImage, insertVideo, insertFile, insertTable, undo, redo, clearFormatting, selectAll, html"}}" class="text_block" name="{{ $name }}">{{ $value }}</textarea>
