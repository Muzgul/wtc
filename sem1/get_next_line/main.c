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
	// int		fd;
	// int		gnl_ret;

	// out = dup(1);
	// pipe(p);

	// fd = 1;
	// dup2(p[1], fd);
	// write(fd, "abc\n\n", 5);
	// close(p[1]);
	// dup2(out, fd);

	// /* Read abc and new line */
	// gnl_ret = get_next_line(p[0], &line);
	// printf("%d\n", gnl_ret);
	// printf("%d\n", strcmp(line, "abc"));
	// printf("%s\n", line);

	//  Read new line 
	// gnl_ret = get_next_line(p[0], &line);
	// printf("%d\n", gnl_ret);
	// printf(":%s:\n", line);

	// /* Read again, but meet EOF */
	// gnl_ret = get_next_line(p[0], &line);
	// printf("%d\n", gnl_ret);
	// printf(":%s:\n", line);

	// /* Let's do it once again */
	// gnl_ret = get_next_line(p[0], &line);
	// printf("%d\n", gnl_ret);
	// printf(":%s:\n", line);
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
		ft_putendl("LINE");
		ft_putendl(line);
		printf("Strcmp: %i\n", ft_strcmp(line, "1234567890abcde"));
		free (line);
	}
	return (1);
}
