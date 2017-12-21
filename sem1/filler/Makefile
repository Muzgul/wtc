NAME = MIMIC_FILLER.filler
FLAGS = gcc -Wall -Werror -Wextra
SOURCES = filler.c filler_check.c filler_grid.c filler_misc.c

OBJECTS = $(SOURCES:.c=.o)

all: $(NAME)

$(NAME):
	@make -C libft
	@$(FLAGS) -c $(SOURCES)
	@$(FLAGS) -o $(NAME) $(OBJECTS) -L libft/ -lft	

clean:
	@make -C libft/ clean
	@/bin/rm -f $(OBJECTS)

fclean: clean
	@make -C libft/ fclean
	@/bin/rm -f $(NAME)

re: fclean all 