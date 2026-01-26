import api from "@/plugins/axios";

export interface Node {
  name: string;
  path: string;
  // untuk file
  size?: number;
  last_modified?: string;
  mime_type?: string;
  url?: string;

  // untuk folder
  files?: Node[];
  directories?: Node[];
}

class FileManagerService {
  static async getAll(): Promise<Node> {
    const { data } = await api.get("api/mx-filemanager");
    return data;
  }
  static async createDir(parent: string, name: string): Promise<void> {
    await api.post("api/mx-filemanager/create-dir", { parent, name });
  }
}

export default FileManagerService;
