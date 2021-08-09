<template>
  
    <div class="buttons" v-if="editor">
      <button class="bg-red-300" @click.prevent="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
        bold
      </button>
      <button @click.prevent="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
        italic
      </button>
      <button @click.prevent="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
        strike
      </button>
      <button @click.prevent="editor.chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
        code
      </button>
      <button @click.prevent="editor.chain().focus().unsetAllMarks().run()">
        clear marks
      </button>
      <button @click.prevent="editor.chain().focus().clearNodes().run()">
        clear nodes
      </button>
      <button @click.prevent="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
        paragraph
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
        h1
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
        h2
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
        h3
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
        h4
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
        h5
      </button>
      <button @click.prevent="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
        h6
      </button>
      <button @click.prevent="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
        bullet list
      </button>
      <button @click.prevent="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
        ordered list
      </button>
      <button @click.prevent="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
        code block
      </button>
      <button @click.prevent="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
        blockquote
      </button>
      <button @click.prevent="editor.chain().focus().setHorizontalRule().run()">
        horizontal rule
      </button>
      <button @click.prevent="editor.chain().focus().setHardBreak().run()">
        hard break
      </button>
      <button @click.prevent="editor.chain().focus().undo().run()">
        undo
      </button>
      <button @click.prevent="editor.chain().focus().redo().run()">
        redo
      </button>
    </div>
    
    <editor-content :editor="editor"  />
 
</template>

<script>
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'

export default {
  components: {
    EditorContent,
  },

  props: {
    modelValue: {
      type: String,
      default: '',
    },
  },

  data() {
    return {
      editor: null,
    }
  },

  watch: {
    modelValue(value) {
      const isSame = this.editor.getHTML() === value

      if (isSame) {
        return
      }

      this.editor.commands.setContent(this.modelValue, false)
    },
  },

  mounted() {
    this.editor = new Editor({
      content: this.modelValue,
      extensions: [
        StarterKit,
      ],
      onUpdate: () => {
        this.$emit('update:modelValue', this.editor.getHTML())
      },
    })
  },

  beforeUnmount() {
    this.editor.destroy()
  },
}
</script>

<style lang="scss" scoop>
/* Basic editor styles */
.ProseMirror {
  > * + * {
    margin-top: 0.75em !important;
  }

  ul,
  ol {
    padding: 0 1rem !important;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    line-height: 1.1 !important;
  }

  code {
    background-color: rgba(#616161, 0.1) !important;
    color: #616161 !important;
  }

  pre {
    background: #0D0D0D !important;
    color: #FFF !important;
    font-family: 'JetBrainsMono', monospace !important;
    padding: 0.75rem 1rem !important;
    border-radius: 0.5rem !important;

    code {
      color: inherit !important;
      padding: 0 !important;
      background: none !important;
      font-size: 0.8rem !important;
    }
  }

  img {
    max-width: 100% !important;
    height: auto !important;
  }

  blockquote {
    padding-left: 1rem !important;
    border-left: 2px solid rgba(#0D0D0D, 0.1) !important;
  }

  hr {
    border: none !important;
    border-top: 2px solid rgba(#0D0D0D, 0.1) !important;
    margin: 2rem 0 !important;

  }
}
</style>