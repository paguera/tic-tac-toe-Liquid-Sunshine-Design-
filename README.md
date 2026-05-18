# PHP Morpion

Un jeu de morpion simple en PHP natif.

## Configuration Docker

### Lancement
Le projet est configuré pour se lancer sur le port **8081**.
```bash
docker compose up -d
```

### Auto-start
Le conteneur est configuré avec `restart: always`. Il redémarrera automatiquement au démarrage du serveur ou en cas de crash.

## Configuration Reverse Proxy (Nginx)

Pour rendre le projet accessible via `https://gvf.duckdns.org/tic-tac-toe`, ajoutez ce bloc dans votre configuration Nginx (`/etc/nginx/sites-available/portfolio`) :

```nginx
location /tic-tac-toe/ {
    proxy_pass http://localhost:8081/;
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

**Note importante :** Le `/` à la fin de `proxy_pass` est indispensable pour que les ressources (CSS, JS) soient correctement redirigées.

## Intégration Portfolio
- URL externe : `https://gvf.duckdns.org/tic-tac-toe`
- Port interne : `8081`
# tic-tac-toe-Liquid-Sunshine-Design-
