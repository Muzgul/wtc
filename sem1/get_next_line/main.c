#include "get_next_line.h"
#include "libft/libft.h"
#include <sys/types.h>
#include <sys/uio.h>
#include <unistd.h>
#include <fcntl.h>
#include <stdio.h>

int     main()
{
	// char 	*line;
	// int		out;
	// int		p[2];
	// char 	*str;
	// int		gnl_ret;

	// str = (char *)malloc(1000 * 1000);
	// *str = '\0';
	// strcat(str, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in leo dignissim, gravida leo id, imperdiet urna. Aliquam magna nunc, maximus quis eleifend et, scelerisque non dolor. Suspendisse augue augue, tempus");
	// strcat(str, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in leo dignissim, gravida leo id, imperdiet urna. Aliquam magna nunc, maximus quis eleifend et, scelerisque non dolor. Suspendisse augue augue, tempus");
	// strcat(str, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur in leo dignissim, gravida leo id, imperdiet urna. Aliquam magna nunc, maximus quis eleifend et, scelerisque non dolor. Suspendisse augue augue, tempus");
	// out = dup(1);
	// pipe(p);
	// dup2(p[1], 1);

	// write(1, str, strlen(str));
	// close(p[1]);
	// dup2(out, 1);
	// gnl_ret = get_next_line(p[0], &line);
	// printf("strcmp: %d\n", strcmp(line, str));
	// printf("ngl_ret: %d\n", gnl_ret);
	// printf("%s\n", line);
	int     fd;
	char    *line;
	int		i;

	fd = open("some.txt", O_RDONLY);
	if (fd == -1)
	{
		ft_putstr("open() error");
		return (1);
	}
	while ((i = get_next_line((int const)fd, &line)) > 0)
	{
		printf("\t** Line ** :%s:\n", line);
		printf("Strcmp: %i\n", ft_strcmp(line, "1234567890abcde"));
		free (line);
	}
	return (1);
}
