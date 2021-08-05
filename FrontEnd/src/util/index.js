export const file_blob = (file) => 
    new Promise(async (resolve, reject) => {
        if (!file) reject();
    

        const blob = new Blob([new Uint8Array(await file.arrayBuffer())], {
            type: file.type,
        })

        const fr = new FileReader();

        fr.readAsDataURL(blob);
        fr.onloadend = () => resolve(fr.result)
        fr.onerror = (error) => reject(error);
    });


export const byte_size = (str) => new Blob([str].size);