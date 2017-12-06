#include "get_next_line.h"
#include "libft/libft.h"
#include <sys/types.h>
#include <sys/uio.h>
#include <unistd.h>
#include <fcntl.h>
#include <stdio.h>

int     main()
{
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
