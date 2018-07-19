package tircnais.lojacuidadocercano;

public class MiURL {
    private String IPservidor = "http://192.168.1.8/";
    private String proyecto = "Cuidado/";
    private String pagina = "";

    public void setPagina(String pagina) {
        this.pagina = pagina;
    }

    public String getIPservidor() {
        return IPservidor;
    }

    public String getProyecto() {
        return proyecto;
    }

    public String getPagina() {
        return pagina;
    }

}
