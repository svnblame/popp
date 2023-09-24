## PHP Objects, Patterns, and Practice

### Docker
#### Build

- Ensure Docker App is running on Host
- `docker build -t popp-image .`

#### Verify image was created

- `docker image ls | grep popp-image`

#### Run the image in the background (daemonize)

- `docker compose up -d`

#### Shell into the image

- Get container name: `docker ps | grep popp-image`